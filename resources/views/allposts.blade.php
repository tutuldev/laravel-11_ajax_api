
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-8 bg-primary text-white mb-4">
            <h1>All Posts</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <a href="/addpost" class="btn  btn-sm btn-primary">Add New</a>
            <button class="btn btn-sm btn-danger" id="logoutBtn">Logout</button>
        </div>
     </div>

            <div class="row">
                <div class="col-8">
                    <div id="postContainer">
                        <table class="table table-bordered table-striped ">
                            <tr class="table-dark">
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>View</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            <tr>
                                <td><img src="" alt="" width="150px"></td>
                                <td>
                                    <h6>Post Title</h6></td>
                                </td>
                                <td>
                                    <p>
                                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae placeat sit
                                    </p>
                                </td>
                                <td><button>View</button></td>
                                <td><button>Update</button></td>
                                <td><button>Delete</button></td>
                              </tr>
                        </table>
                    </div>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
{{-- ajax with fetch method--}}
<script>
document.querySelector("#logoutBtn").addEventListener('click',function(){
    const token = localStorage.getItem('api_token');

    fetch('/api/logout',{
        method:'POST',
        headers:{
            'Authorization': `Bearer ${token}`
        }
    })
    .then(response => response.json())
    .then(data =>{
        console.log(data);
        window.location.href = "/"
    });
});

function loadData(){
    const token = localStorage.getItem('api_token');

fetch('/api/posts',{
    method:'GET',
    headers:{
        'Authorization': `Bearer ${token}`
    }
})
.then(response => response.json())
.then(data =>{
    // console.log(data);
    console.log(data.data.posts);
    var allpost = data.data.posts;
    const postContainer = document.querySelector("#postContainer");
              var tabledata= `  <table class="table table-bordered table-striped ">
                            <tr class="table-dark">
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>View</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>`;

                            allpost.forEach(post =>{
                               tabledata +=`<tr>
                                <td><img src="/uploads/${post.image}" alt="" width="150px" height="100px"></td>
                                <td>
                                    <h6>${post.title}</h6></td>
                                </td>
                                <td>
                                    <p>
                                        <h6>${post.description}</h6></td>

                                    </p>
                                </td>
                                <td><button type="button" class="btn btn-sm btn-primary">View</button></td>
                                <td><button type="button" class="btn btn-sm btn-success">Update</button></td>
                                <td><button class="btn btn-sm btn-danger">Delete</button></td>
                              </tr>`
                            });

                       tabledata += `</table>`;

                       postContainer.innerHTML = tabledata;
});

}
loadData();
</script>
</body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRUD Application Using Vue.js & Axios, PHP & MySQL</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
                integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://kit.fontawesome.com/e12fdf560c.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Vue App -->
        <div id="crudApp">
            <!-- Navbar -->
            <div class="container-fluid">
                <div class="row bg-dark">
                    <div class="col-lg-12">
                        <p class="text-center text-light display-5 pt-2">CRUD Application Using Vue.js & Axios, PHP & MySQL</p>
                    </div>
                </div>
            </div>
            <!-- Navbar End-->

            <!-- Content -->
            <div class="container mt-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <!-- Title - Add Button -->
                        <div class="row mt-5">
                            <div class="col-lg-6">
                                <h3 class="text-info">Registered Users</h3>
                            </div>
                            <div class="col-lg-6">
                                <button class="btn btn-info float-right" @click="openModel">
                                    <i class="fas fa-user"></i>&nbsp;&nbsp;Add New User
                                </button>
                            </div>
                        </div>
                        <!-- Title - Add Button End -->
                    </div>
                    <!-- User Show -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mt-3">
                                <thead>
                                    <tr class="text-center bg-dark text-light">
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>E-mail Address</th>
                                        <th>Phone Number</th>
                                        <th>Edit User Info</th>
                                        <th>Delete User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center" v-for="row in allData">
                                        <td>{{ row.first_name }}</td>
                                        <td>{{ row.last_name }}</td>
                                        <td>{{ row.email }}</td>
                                        <td>(+90) {{ row.phone }}</td>
                                        <td><button type="button" name="edit" class="btn btn-warning btn-xs edit" @click="fetchData(row.id)"><i class="fas fa-edit">&nbsp;&nbsp;Edit</button></td>
                                        <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" @click="deleteData(row.id)"><i class="fas fa-trash">&nbsp;&nbsp;Delete</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- User Show End -->
                <!-- Add User Modal -->
                <div v-if="myModel">
                    <transition name="model">
                        <div class="modal-mask">
                            <div class="modal-wrapper">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add New User</h5>
                                            <button type="button" class="close" @click="myModel=false"><span aria-hidden="true">&times;</span></button>
                                        </div>

                                        <div class="modal-body p-4">
                                            <div class="form-group">
                                                <label>Enter First Name</label>
                                                <input type="text" class="form-control" v-model="first_name" />
                                            </div>
                                            <div class="form-group">
                                                <label>Enter Last Name</label>
                                                <input type="text" class="form-control" v-model="last_name" />
                                            </div>
                                            <div class="form-group">
                                                <label>Enter E-mail Address</label>
                                                <input type="email" class="form-control" v-model="email" />
                                            </div>
                                            <div class="form-group">
                                                <label>Enter Phone Number</label>
                                                <input type="text" class="form-control" v-model="phone" />
                                            </div>
                                            <div class="align-center">
                                                <input type="hidden" v-model="hiddenId" />
                                                <input type="button" class="btn btn-success btn-xs btn-block float-right" v-model="actionButton" @click="submitData" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
                <!-- Add User Modal End -->
            </div>
            <!-- Content End -->
        </div>
        <!-- Vue App End -->

        <!-- main.js -->
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student -Home</title>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
<div class="content-wrapper" id="app">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 py-5">
                    <div class="card ">
                        <div class="card-header text-title">All Student</div>
                        <div class="card-body">
                            <table class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Institute</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in lists">
                                        <td>@{{item.id}}</td>
                                        <td>@{{item.student_name}}</td>
                                        <td>@{{item.student_department}}</td>
                                        <td>@{{item.student_institute}}</td>
                                        <td>
                                            <button  @click.prevent="edit(item.id)"  data-bs-toggle="modal" data-bs-target="#exampleModal" class="action btn btn-info btn-sm text-light"><i class="fa fa-edit"></i> </button>
                                            <button  @click.prevent="deleteStudent(item.id)" class="action btn btn-danger btn-sm"><i class="fa fa-delete"></i> </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 py-5">
                    <div class="card">
                        <div class="card-header text-title">Add Student</div>
                        <div class="card-body">
                            <form  @submit.prevent="saveStudent">

                                <fieldset>
                                    <p v-if="errors.length">
                                        <b>Please correct the following error(s):</b>
                                        <ul>
                                            <li class="text-danger" v-for="error in errors">
                                            @{{ error }}
                                            </li>
                                        </ul>
                                    </p>

                                    <div class="form-group">
                                        <label for="student_name"></label>
                                        <input type="text" v-model="form.student_name" class="form-control" name="student_name" value="" id="student_name" placeholder="Enter Name"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="student_department"></label>
                                        <input type="text" class="form-control" v-model="form.student_department" name="student_department" id="student_department" placeholder="Enter Department" />
                                    </div>
                                    <div class="form-group">
                                        <label for="student_institute"></label>
                                        <input type="text" class="form-control" v-model="form.student_institute" name="student_institute" id="student_institute" placeholder="Enter Institute" />
                                    </div>
                                    <div class="form-group align-right mt-2">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>




<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.6.1.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/axios.min.js')}}"></script>
<script src="{{asset('assets/js/vue.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2@11.js')}}"></script>
<script src="{{asset('assets/js/all.min.js')}}"></script>
{{--<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>--}}



<script>
    const  app = new Vue({
        el:'#app',
        data:{
            lists:[],
            errors:[],
            form:{
                id:" ",
                student_name:"",
                student_department:"",
                student_institute:""
            }
        },

        methods:{

            show : function(){
                axios.get("/student/getData")
                    .then(response=>{
                        this.lists = response.data;
                    })
            },

            edit : function(id){
                axios.get("/student/edit/")
                    .then(response =>{
                        this.lists                    = response.data.student;
                        this.form.id                  = student.id
                        this.form.student_name        = student.student_name
                        this.form.student_department  = student.student_department
                        this.form.student_institute   = student.student_institute
                    })
            },

            cleanError : function (){
                this.errors =[];
            },

            checkForm : function (){
                if(this.form.student_name== ""){
                    this.errors.push('student name field is required')
                }
                if(this.form.student_department== ""){
                    this.errors.push('student department field is required')
                }
                if(this.form.student_institute == ""){
                    this.errors.push('student institute field is required')
                }
            },

            clearData: function(){
                this.form.student_name = ('')
                this.form.student_department = ('')
                this.form.student_institute = ('')
            },

            saveStudent : function(event){
                this.cleanError();
                this.checkForm();
                if(this.errors.length === 0){
                    axios
                        .post('/student/store' , this.form)
                        .then(() =>{
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Student Added Successfully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.clearData();
                            this.show();
                        })
                        .catch((error) =>(this.errors.push = error.response.data.errors));

                }
            },

            deleteStudent: function (id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                    .then((result) => {
                        if (result.isConfirmed) {
                            axios.get(`/delete/student/${id}`)
                                .then(response=>{
                                    // this.view();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                })
                        }
                    })

            }

        },
        mounted(){
            this.show()
        }
    });
</script>
</body>
</html>

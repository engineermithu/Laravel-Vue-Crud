<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student -Home</title>
{{--    CSS Link--}}
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

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
                            <table id="example" class="table table-striped"  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Institute</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in lists">
                                        <td>@{{item.id}}</td>
                                        <td>@{{item.student_name}}</td>
                                        <td>@{{item.student_department}}</td>
                                        <td>@{{item.student_institute}}</td>
                                        <td> <img style="width:50px;heigth:40px;" v-bind:src="'/images/students/' +item.student_image"
                                                  class="img-thumbnail rounded" /> </td>
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
                                    <div class="form-group">
                                        <label for="student_image"></label>
                                        <input type="file" class="form-control"  @change="onFileChange" name="student_image" id="student_image" accept="image/*"/>
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

{{-- Modal Section--}}
    <div class="modal editModel" tabindex="-1" id="exampleModal" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title">Edit Student Information</p>
                    <button type="button" id="exampleModals" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateStudent(student.id)" >
                        <fieldset>
                            <div class="mb-3">
                                <label for="student_name" class="form-label">Student Name</label>
                                <input type="text" v-model="student.student_name" class="form-control" id="student_name" placeholder="Enter Student Name">
                            </div>
                            <div class="mb-3">
                                <label for="student_department" class="form-label">Student Department</label>
                                <input type="text" v-model="student.student_department" id="student_department" class="form-control"
                                       placeholder="Enter Student Department">
                            </div>

                            <div class="mb-3">
                                <label for="student_institute" class="form-label">Student Institute</label>
                                <input type="text"  v-model="student.student_institute " class="form-control" id="student_institute"  placeholder="Enter Student Institute">
                            </div>

                            <div class="form-group mb-3">
                                <label for="student_image"></label>
                                <input type="file"  @change="onImageUpdate" name="image"
                                       accept="image/*"  class="form-control">

                                <img style="width:70px;heigth:60px;"  :src="'/images/students/' +student.student_image"
                                     class="img-thumbnail rounded m-2" />
                            </div>
                            <button type="submit"  class="btn btn-primary">Update</button>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

{{--JS Link--}}
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.6.1.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/axios.min.js')}}"></script>
<script src="{{asset('assets/js/vue.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2@11.js')}}"></script>
<script src="{{asset('assets/js/all.min.js')}}"></script>
<script>
    const  app = new Vue({
        el:'#app',
        data:{
            lists:[],
            errors:[],
            form:{
                id:"",
                student_name:"",
                student_department:"",
                student_institute:"",
                student_image:""
            },
            student: {},
        },

        methods:{

            //=============== View Data ===============
            show : function(){
                axios.get("/student/getData")
                    .then(response=>{
                        this.lists = response.data;
                    })
            },

            //============= Input Validation ============
            checkForm : function (){
                if(this.form.student_name== ""){
                    this.errors.push('StudentRepository name field is required')
                }
                if(this.form.student_department== ""){
                    this.errors.push('StudentRepository department field is required')
                }
                if(this.form.student_institute == ""){
                    this.errors.push('StudentRepository institute field is required')
                }
                if(this.form.student_image == ""){
                    this.errors.push('StudentRepository image field is required')
                }
            },

            //=============== Error Clear ==============
            cleanError : function (){
                this.errors =[];
            },

            //================ Clear Data =================
            clearData: function(){
                this.form.student_name = ('')
                this.form.student_department = ('')
                this.form.student_institute = ('')
                this.form.student_image = ('')
            },

            //================= File Change =================
            onFileChange(event){
                this.form.student_image = event.target.files[0];
                console.log( this.form.student_image)
            },

            //=============== File Change Update==============
            onImageUpdate(e) {
                this.student.student_image = e.target.files[0];
                console.log(this.student.student_image);
            },

            //================= Store Data ===================
            saveStudent : function(event){
                // const config = {
                //     headers: {
                //         'content-type': 'multipart/form-data'
                //     }
                // }
                var formData = new FormData();
                Object.entries(this.form).forEach(([key, value]) => {
                    formData.append(key, value);
                });
                this.cleanError();
                this.checkForm();
                if(this.errors.length === 0){
                    console.log(this.form)
                    axios.post('/student/store' ,formData)
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

            //================= Edit Data ===================
            edit : function(id){
                axios.get(`/student/edit/${id}`)
                    .then(response =>{
                        this.student = response.data.student;
                        // console.log(response)
                        // student                       = response.data.student;
                        // this.form.id                  = student.id,
                        // this.form.student_name        = student.student_name,
                        // this.form.student_department  = student.student_department,
                        // this.form.student_institute   = student.student_institute
                        // this.form.student_image       = student.student_image
                    })
            },
            //================= Update Data ===================
            updateStudent: function (id){
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                axios.post(`/student/update/${id}`, this.student, config)
                    .then(response =>{
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Student Updated Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.student = {};
                        this.show();
                        this.clearData();

                        $('#exampleModals').trigger('click');
                        // $('.editModel').modal('toggle');
                    })
            },

            //================= Delete Data ===================
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
                            axios.delete(`/delete/student/${id}`)
                                .then(response=>{
                                    // this.view();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                })
                        }
                        this.show();
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












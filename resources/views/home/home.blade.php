<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Home</title>
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
                            <table class="table table-border">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Institute</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
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
{{--                                    <p v-if="errors.length">--}}
{{--                                        <b>Please correct the following error(s):</b>--}}
{{--                                        <ul>--}}
{{--                                            <li class="text-danger" v-for="error in errors">--}}
{{--                                            @{{ error }}--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </p>--}}

                                    <div class="form-group">
                                        <label for="student_name"></label>
                                        <input type="text" v-model="form.student_name" class="form-control" name="student_name" value="" id="student_name" placeholder="Enter Name"
                                               />
                                    </div>
                                    <div class="form-group">
                                        <label for="student_department"></label>
                                        <input type="text" class="form-control" v-model="form.student_department" name="student_department" id="student_department"
                                               placeholder="Enter Department" />
                                    </div>
                                    <div class="form-group">
                                        <label for="student_institute"></label>
                                        <input type="text" class="form-control" v-model="form.student_institute" name="student_institute" id="student_institute" placeholder="Enter Institute"
                                               />
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

{{--<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>--}}



<script>
    const  app = new Vue({
        el:'#app',
        data:{
            lists:[],
            error:[],
            form:{
                id:" ",
                student_name:"",
                student_department:"",
                student_institute:""
            }
        },

        methods:{
            show : function(){
                axios.get("/vue-crud/student/getData")
                    .then(response=>{
                        this.lists = response.data.student;
                    })
            },


            edit : function(student_id){
                axios.get("/vue-crud/student/edit/")
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
                if(this.form.student_name ==" "){
                    this.errors.push('student name field is required')
                }
                if(this.form.student_department == ""){
                    this.errors.push('student department field is required')
                }
                if(this.form.student_institute == ""){
                    this.errors.push('student institute field is required')
                }
            },
            saveStudent : function(event){
                this.cleanError();
                this.checkForm();

                if(this.errors.length === 0){
                    axios
                        .post('http://localhost/vue-crud/public/student/store' , this.form)
                        .then(() =>{
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Student added successfully',
                                showConfirmButton: false,
                                timer: 3500
                            })
                            this.view();
                        })
                        .catch((error) =>(this.errors.push = error.response.data.errors))

                }
            }
        }
    });
</script>
</body>
</html>

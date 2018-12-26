<template>
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <button @click="showModal()" class="btn btn-primary btn-sm float-right">
                            + Add Task
                        </button>
                        Task List
                    </div>
                     <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Task Title</th>
                                    <th>Level</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(task, index) in tasks" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ task.title }}</td>
                                    <td>{{ task.prior }}</td>
                                    <td>
                                        <button @click="updateTask(task)" class="btn btn-info btn-sm">Edit</button>
                                        <button @click="deleteTask(task)" class="btn btn-danger btn-sm">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                     </div>

                     <div class="card-footer text-muted">
                          <ul class="pagination">
                            <li v-bind:class="[{dissabled: !pagination.prev_page_url}]" class="page-item"><a @click="getTask(pagination.prev_page_url)" class="page-link" href="#">Previous</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>
                            <li  v-bind:class="[{dissabled: !pagination.next_page_url}]" class="page-item"><a @click="getTask(pagination.next_page_url)" class="page-link" href="#">Next</a></li>
                          </ul>
                     </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div v-if="errors.length > 0" class="alert alert-danger" role="alert">
                        <ul>
                            <li v-for="(error, index) in errors" :key="index">
                                {{error}}
                            </li>
                        </ul>
                </div>
                <div class="form-group">
                    <label for="">Task Title</label>
                    <input v-model="task.title" type="text" class="form-control" id="" name="">
                </div>

                <div class="form-group">
                    <label for="">Priority</label>
                    <select v-model="task.prior" name="prior" id="" class="form-control">
                        <option value="low">LOW</option>
                        <option value="medium">Medium</option>
                        <option value="high">high</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" @click="resetModal()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" @click="saveTask()" class="btn btn-primary">Submit</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            tasks:[],
            task:{
                title: '',
                prior: '',
                id: ''
            },
            errors:[],
            edit:false,
            pagination:{}
        }
    },
    methods:{
        showModal(){
            $("#modal-form").modal("show");
        },
        getTask(page_url){
            let url=page_url || '/task';
            axios.get(url)
               .then(response=>{
                    this.tasks = response.data.data;
                    this.createPagination(response.data.meta,response.data.links);
               });
        },
        saveTask(){
          if(this.edit === false){
                axios.post('/task',{
                title:this.task.title,
                prior:this.task.prior
            })
            .then(response=>{
                this.getTask();
                this.resetModal();
                $("#modal-form").modal("hide");
            })
            .catch(error=>{
                    this.errors=[];
                    if(error.response.data.errors.title){
                        this.errors.push(error.response.data.errors.title[0]);
                    }
                    if(error.response.data.errors.prior){
                        this.errors.push(error.response.data.errors.prior[0]);
                    }
            })
          }else{
              axios.put('/task/' + this.task.id,{
                      title:this.task.title,
                      prior:this.task.prior
              })

            .then(response=>{
                this.getTask();
                this.resetModal();
                $("#modal-form").modal("hide");
            })
            .catch(error=>{
                    this.errors=[];
                    if(error.response.data.errors.title){
                        this.errors.push(error.response.data.errors.title[0]);
                    }
                    if(error.response.data.errors.prior){
                        this.errors.push(error.response.data.errors.prior[0]);
                    }
            })
            }
        },

        updateTask(task){
           this.task.id=task.id,
           this.task.title=task.title,
           this.task.prior=task.prior,
           this.edit=true;
           this.showModal();
        },
        deleteTask(task){
            let decision=confirm('Are You Sure');
            if(decision === true){
                axios.delete('/task/' + task.id)
                .then(response=>{
                    this.getTask();
                })

                .catch(error=>{
                    console.log(error);
                })
            }
        },
        resetModal(){
            this.task.title='';
            this.task.prior='';
            this.edit=false;
        },
        createPagination(meta,links){
            let pagination={
                current_page:meta.last_page.current_page,
                last_page:meta.last_page,
                next_page_url:links.next,
                prev_page_url:links.prev
            }

            this.pagination=pagination;
        }
    },
    mounted() {
            this.getTask();
        }
}
</script>

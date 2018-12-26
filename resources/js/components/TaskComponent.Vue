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
                                <tr>
                                    <td>1</td>
                                    <td>Task Title</td>
                                    <td>Level</td>
                                    <td>
                                        <button class="btn btn-info btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
                <div class="form-group">
                    <label for="">Task Title</label>
                    <input type="text" class="form-control" id="" name="">
                </div>

                <div class="form-group">
                    <label for="">Priority</label>
                    <select name="prior" id="" class="form-control">
                        <option value="low">LOW</option>
                        <option value="medium">Medium</option>
                        <option value="high">high</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    methods:{
        showModal(){
            $("#modal-form").modal("show");
        }
    },
    mounted() {
            this.showModal();
        }
}
</script>

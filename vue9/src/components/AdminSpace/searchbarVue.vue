<template>
    <div class="container">
         <div class="row">
             <div class="col-md-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control input-text" placeholder="Search activites...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                   <button class="btn btn-outline-warning btn-lg" type="button"><i class="fa fa-search"></i></button>
                </div>
                </div>

            </div>

          </div>
      </div>

</template>
<style scoped>
.container {
    padding-top: 20px;
    padding-left: 400px;
}

.btn:hover {
    color: #fff;

}

.input-text:focus {


    box-shadow: 0px 0px 0px;
    border-right-color: #f8c146;
    border-color: orange;
    outline: 0px;
}

.form-control {
    margin-right: 10px;

    border: 1px solid #f8c146;
}
</style>
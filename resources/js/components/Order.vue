<template>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">  {{ order   }}  </div>

                    <div class="card-body">
                        {{ user   }}
                    </div>
                </div>
            </div>
        </div>

  </template>

  <script>


    export default {
        props: ['order' , 'user'],
     setup(props) {
        // setup() receives props as the first argument.
          console.log(props.order)
     }
      ,mounted() {
        console.log(this.order)
        console.log("order mounted");
      }
    };
  </script>

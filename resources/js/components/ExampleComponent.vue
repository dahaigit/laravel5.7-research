<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">案例组件</div>

                    <div class="card-body">
                        我是案例组件
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('我是案例组件')
            window.Echo.channel('project').listen('.sayOk',(e) => {
                console.log(e);
            });

            window.Echo.private('priv-channel.1')
                .listen('Priv', (e) => {
                    console.log(e);
                });
            let schoolId = 3;
            window.Echo.private('safe.' + schoolId)
                .listen('.safeOk', (e) => {
                console.log(e);
            })
            // listen notification
            window.Echo.private('.users.' + 1)
                .notification((notification) => {
                    console.log(notification);
                })
        }
    }
</script>

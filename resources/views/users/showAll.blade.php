<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="pt-7 pb-7">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <ul id="users">

                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div
        x-data="data()"
        x-init="getUsers()">
    </div>



    @push('scripts')

    <script>
        function data(){
            // debe rotornar un objeto
            return {
                openMan: null,
                users: {},
                start(){
                    this.openMan = false
                },
                async getUsers(){

                    this.users = await (await fetch('/api/users')).json();
                    // console.log(this.users);
                    // let users = this.users;
                    const usersElement = document.getElementById('users');

                    this.users.forEach((user, index) => {
                        let element = document.createElement('li');
                        element.setAttribute('id', user.id);
                        element.innerText = user.name;
                        usersElement.appendChild(element);
                    });
                }
            }
        }
    </script>

    <script>
        window.onload=function(){
            Echo.channel('users')
            .listen('UserCreated', (e) => {
                const usersElement = document.getElementById('users');
                let element = document.createElement('li');
                    element.setAttribute('id', e.user.id);
                    element.innerText = e.user.name;
                    usersElement.appendChild(element);
            })
            .listen('UserUpdated', (e) => {
                let element = document.getElementById(e.user.id);
                    element.innerText = e.user.name;
            })
            .listen('UserDeleted', (e) => {
                let element = document.getElementById(e.user.id);
                    element.parentNode.removeChild(element);
            })
        }


    </script>


    <script>

        // const FORM_URL = "https://submit-form.com/technotrampoline";
        // function getUsers() {
        //     this.users = await (await fetch('/api/users')).json();

        //     // log out all the posts to the console
        //     console.log(this.users);
        // }

        // console.log('hola mundo');
        // axios.get('/api/users')
        //     .then((response) => {
        //         const usersElement = document.getElementById('users');
        //         let users = response.data;
        //         console.log('user');
        //         users.forEach((user, index) => {
        //             let element = document.createElement('li');
        //             element.setAttribute('id', user.id);
        //             element.innerText = user.name;
        //             usersElement.appendChild(element);
        //         });
        //     });

            // window.axios({
            //     method: 'get',
            //     url: 'https://bit.ly/2mTM3nY',
            //     responseType: 'stream'
            // })
            // .then(function (response) {
            //     response.data.pipe(fs.createWriteStream('ada_lovelace.jpg'))
            // });

    </script>

@endpush

</x-app-layout>


{{-- <div
        x-data="{
            users: {},

            async retrievePosts() {
                this.users = await (await fetch('/api/users')).json();

                // log out all the posts to the console
                console.log(this.users);
            }
        }"
        x-init="retrievePosts">
    </div> --}}

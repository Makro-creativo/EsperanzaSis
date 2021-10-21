<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


const app = new Vue({
    el: '#app',

    data: {
        name: '',
        address: '',
        clients: [],
    },

    methods: {
        createClient() {
            return axios.post('/new-client.php', {
                name: this.name,
                address: this.address
            })
            .then(function(response) {
                if(!this.name && !this.address && this.name === null && this.address === null) {
                    return;
                }

                this.clients = response.body;


                this.name = '';
                this.address = '';
            })
            .catch(function(error) {
                console.log(error);
            });
        },

        deleteClients(id) {
            return axios.delete(`/delete-client.php/${id}`)
                .then(function(response) {
                    console.log(response);
                })
                .catch(function(error) {
                    console.error(error);
                });
        }

    }
});
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


const app = new Vue({
    el: '#app',

    data: {
        name: '',
        address_fiscal: '',
        name_company: '',
        rfc: '',
        address_company: '',
        giro_company: '',
        manager_payments: '',
        cp: '',
        clients: [],
    },

    methods: {
        createClient() {
            return axios.post('/new-client.php', {
                name: this.name,
                address_fiscal: this.address_fiscal,
                name_company: this.name_company,
                rfc: this.rfc,
                address_company: this.address_company,
                giro_company: this.giro_company,
                manager_payments: this.manager_payments,
                cp: this.cp

            })
            .then(function(response) {
                if(!this.name && !this.address_fiscal && this.name === null && this.address_fiscal === null) {
                    return;
                }

                this.clients = response.body;


                this.name = '';
                this.address_fiscal = '';
                this.name_company = '';
                this.rfc = '';
                this.address_company = '';
                this.giro_company = '';
                this.manager_payments = '';
                this.cp = '';

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
<template>
    <div class="card">
        <div class="card-header"><h4>{{ heading }}</h4></div>
        <div class="card-body">
            <form method="POST" :action="route" v-on:submit.prevent>
                <div class="form-group row">
                    <label for="amount" class="col-md-12 col-form-label">
                        Amount <span class="small">(Example: 7.50)</span>
                        <p class="alert alert-danger small" v-if="errorMessage != null">{{ errorMessage }}</p>
                    </label>
                    <div class="col-md-12">
                        <input id="amount"
                               type="text"
                               class="form-control"
                               :class="hasErrors"
                               name="amount"
                               v-model="amount"
                               @keydown="clearErrors"
                               required>
                        <span v-for="error in errors" class="invalid-feedback" role="alert">
                            <strong>{{ error }}</strong>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <button @click="formSubmit"
                                :disabled="isProcessing"
                                type="button"
                                class="btn btn-outline-primary">
                            <span class="spinner-border spinner-border-sm"
                                  role="status"
                                  aria-hidden="true"
                                  v-if="isProcessing"></span>
                            {{ button_text }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'transaction-form',
        props: {
            route: {
                type: String,
                required: true
            },
            heading: {
                type: String,
                required: true
            },
            button_text: {
                type: String,
                default: 'Save'
            },
        },
        data() {
            return {
                isProcessing: false,
                amount: null,
                errors: [],
                errorMessage: null
            };
        },
        computed: {
            hasErrors: function () {
                if (this.errors.length > 0) {
                    return 'is-invalid'
                }
            }
        },
        methods: {
            formSubmit() {
                this.isProcessing = true;

                axios.post(this.route, {"amount": this.amount})
                    .then(response => {
                        this.amount = null;
                        console.log(response.data);
                        this.isProcessing = false;

                        //The low budget solutions
                        alert('Success!');
                        window.location.reload();
                    })
                    .catch (error => {console.log(error.response);
                        this.errors = error.response.data.errors.amount;
                        this.errorMessage = error.response.data.message;
                        this.isProcessing = false
                    });
            },

            clearErrors() {
                this.errors = [];
                this.errorMessage = null
            }
        },
        mounted() {
        },
    }
</script>

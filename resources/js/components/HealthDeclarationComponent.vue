<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong>Confidential</strong> Health Declaration</div>

                    <div class="card-body">
                        <template v-for="field in fields_0">
                            <input-field-component @submit="eventHandler($event)" :field="field"></input-field-component>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        mounted() {
            console.log('Component mounted.')
        },

        props: {
            // counties: {
            //     type: Array,
            //     required: true,
            // },
            // universities: {
            //     type: Array,
            //     required: true,
            // },
        },

        data() {
            return {
                fields_0: {
                    health_declaration_1: {
                        id: 'health_declaration_1',
                        name: 'Have you been subject to any sanction under student Fitness to Practise procedures whilst studying at university? Further guidance about what is considered a sanction can be found at:',
                        extra: '',
                        type: 'true_detail', // if true, show detail
                        autocomplete: 'off',
                        error: false,
                        options: {
                            __health_declaration_1__details: {
                                id: '__health_declaration_1__details',
                                name: 'If you are concerned that a physical or mental health problem may impair your ability to undertakr training, you must seek to clarify this with your physician or consultant and make a health declaration in writing to the Registrar. Any information supplied must be marked Confidential and for the attention of the Registrar only.',
                                extra: 'Please note you may also be asked to undertake an occupational health assessment commissioned by the Pharmaceutical Society.',
                                type: 'plaintext',
                                autocomplete: 'off',
                                error: false,
                                options: [],
                                external: false,
                                value: '',
                                required: false,
                            }
                        },
                        external: false,
                        value: false,
                        required: false,
                    },

                    health_declaration_2: {
                        id: 'health_declaration_2',
                        name: 'I declare that all of the information I give in this form and in any supporting documents is accurate.',
                        extra: '',
                        type: 'boolean',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },

                    health_declaration_3: {
                        id: 'health_declaration_3',
                        name: 'I undertake to comply with the principles of the code & supplementary professional standards and guidance published by the Pharmaceutical Society\'s Council.',
                        extra: '',
                        type: 'boolean',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },

                    health_declaration_4: {
                        id: 'health_declaration_4',
                        name: 'I undertake to notify the registrar of any changes to my name, home address or other contact details.',
                        extra: '',
                        type: 'boolean',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },

                    health_declaration_5: {
                        id: 'health_declaration_5',
                        name: 'I undertake to notify the registrar of any character / fitness to practise matters within 7 days of any occurrence throughout my pre-registration year.',
                        extra: '',
                        type: 'boolean',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },

                    health_declaration_6: {
                        id: 'health_declaration_6',
                        name: 'I understand that if the declaration included in this application for pre-registration training is not completed to the satisfaction of the registrar, my application will not be processed.',
                        extra: '',
                        type: 'boolean',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },

                    health_declaration_7: {
                        id: 'health_declaration_7',
                        name: 'I understand that if I am found to have given false or misleading information in connection with my registration on the trainee register, this may be treated as misconduct for the purposes of the Pharmacy (NI) Order 1976, which my result in my removal from the student register.',
                        extra: '',
                        type: 'boolean',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: '',
                        required: true,
                    },

                    submit_step_4: {
                        id: 'submit_step_4',
                        name: 'Proceed to Next Step',
                        extra: '',
                        type: 'submit',
                        autocomplete: 'off',
                        error: false,
                        options: [],
                        external: false,
                        value: 'btn-primary', // when submit this is the class field
                        required: true,
                    },
                },
            }
        },

        methods: {
            eventHandler(fieldId) {
                switch(fieldId) {
                    case 'submit_step_4':

                        // disable the button which was clicked
                        this.$emit('disabled', fieldId);

                        // submit the form
                        this.submitForm(fieldId);
                        break;

                    default:
                        // do nothing if not defined
                        break;
                }
            },

            submitForm(submitTrigger) {

                // Clear all Errors

                var formData = new FormData();

                formData.append('currentStep', 'health_declaration');

                for (const field in this.fields_0) {
                    formData.append([this.fields_0[field].id], this.fields_0[field].value);
                    this.fields_0[field].error = false;

                    if (this.fields_0[field].type == 'true_detail') {
                        let subOption = this.fields_0[field].options[Object.keys(this.fields_0[field].options)[0]];
                        formData.append([subOption.id], subOption.value);
                        subOption.error = false;
                    }
                }

                // submit form here
                var self = this;

                axios.post('/registration', formData)
                    .then(function (response) {

                        // Proceed to next step
                        // console.log(response);

                        // Redirect to the Registration Payment
                        window.location.replace("/registration");

                    })
                    .catch(function (error) {

                        // Set Error Messages
                        for(const currentError in error.response.data.errors) {
                            if(self.fields_0.hasOwnProperty(currentError)) {
                                self.fields_0[currentError].error = error.response.data.errors[currentError][0];
                            } else {
                                console.log(currentError);
                                let subError = currentError.split('__')[1];
                                console.log(subError[1]);

                                if(self.fields_0.hasOwnProperty(subError)) {
                                    self.fields_0[subError].options[currentError].error = error.response.data.errors[currentError][0];
                                }

                            }
                        }

                        // Scroll to top of page smoothly
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });

                        // Re-enable the form
                        self.$emit('enabled', submitTrigger);

                    });

            },
        },

        computed: {
            countyOptions: function() {

            }
        },
    }
</script>

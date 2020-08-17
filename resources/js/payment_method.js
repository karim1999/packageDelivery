import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';

const stripeForm = new Vue({
    el: '#stripeForm',
    components: {
        Loading
    },
    data(){
        return {
            name: '',
            stripeAPIToken: 'pk_test_w3HawkjpIhba191cJ7N4aY9z00aSyq6ubk',
            stripe: '',
            elements: '',
            card: '',
            error: '',
            msg: '',
            isLoading: false
        }
    },
    mounted(){
        this.includeStripe('js.stripe.com/v3/', function(){
            this.configureStripe();
        }.bind(this));
    },
    methods: {
        includeStripe( URL, callback ){
            let documentTag = document, tag = 'script',
                object = documentTag.createElement(tag),
                scriptTag = documentTag.getElementsByTagName(tag)[0];
            object.src = '//' + URL;
            if (callback) { object.addEventListener('load', function (e) { callback(null, e); }, false); }
            scriptTag.parentNode.insertBefore(object, scriptTag);
        },
        configureStripe(){
            this.stripe = Stripe( this.stripeAPIToken );

            this.elements = this.stripe.elements();
            this.card = this.elements.create('card');

            this.card.mount('#card-element');
        },
        submitPaymentMethod(){
            this.error= ""
            this.msg= ""
            if(!this.isLoading){
                this.isLoading= true
                this.stripe.confirmCardSetup(
                    this.$refs.clientSecret.value, {
                        payment_method: {
                            card: this.card,
                            billing_details: {
                                name: this.name
                            }
                        }
                    }
                ).then((result) => {
                    console.log('result', result)
                    if (result.error) {
                        this.error= result.error.message
                    } else {
                        this.msg= result.setupIntent.status
                        return result.setupIntent;
                    }
                    return false
                }).then(setupIntent => {
                    if(setupIntent){
                        return axios.post('/payment_methods', {
                            payment_method: setupIntent.payment_method
                        }).then(res => {
                            console.log('done', res)
                            this.$refs.paymentMethodsUrl.click()
                        })
                    }
                }).catch(error => {
                    console.log('error', error)
                    this.error= error
                }).then(res => {
                    this.isLoading= false
                });
            }
        },
    }
});

import TypeInput from "./components/TypeInput";

const stripeForm = new Vue({
    el: '#addressForm',
    components: {
        TypeInput
    },
    data(){
        return {
            value: "Manual",
            center: {
                lat: 10.0,
                lng: 10.0
            },
            position: {
                lat: 10.0,
                lng: 10.0
            }
        }
    },
    created() {
        //do we support geolocation
        if(!("geolocation" in navigator)) {
            console.log('Geolocation is not available.')
            return;
        }

        // get position
        navigator.geolocation.getCurrentPosition(pos => {
            this.position.lat = pos.coords.latitude;
            this.center.lat = pos.coords.latitude;
            this.position.lng = pos.coords.longitude;
            this.center.lng = pos.coords.longitude;
        }, err => {
            console.log('Geolocation is not available.')
        })
    },
    methods: {
        setValue(value){
            this.value= value
        },
        gMapFunc(event) {
            this.position.lat = event.lat();
            this.position.lng = event.lng();
            console.log(event.lat(), event.lng())
        },
    }
});

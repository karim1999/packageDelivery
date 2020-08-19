import TypeInput from "./components/TypeInput";

const stripeForm = new Vue({
    el: '#packageForm',
    components: {
        TypeInput
    },
    data(){
        return {
            value_from: "Manual",
            how_from: "List",
            value_to: "Manual",
            how_to: "List",
            center_from: {
                lat: 10.0,
                lng: 10.0
            },
            center_to: {
                lat: 10.0,
                lng: 10.0
            },
            position_from: {
                lat: 10.0,
                lng: 10.0
            },
            position_to: {
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
            this.position_from.lat = pos.coords.latitude;
            this.center_from.lat = pos.coords.latitude;
            this.position_from.lng = pos.coords.longitude;
            this.center_from.lng = pos.coords.longitude;
            this.position_to.lat = pos.coords.latitude;
            this.center_to.lat = pos.coords.latitude;
            this.position_to.lng = pos.coords.longitude;
            this.center_to.lng = pos.coords.longitude;
        }, err => {
            console.log('Geolocation is not available.')
        })
    },
    methods: {
        setValue_from(value){
            this.value_from= value
        },
        setHow_from(value){
            this.how_from= value
        },
        gMapFunc_from(event) {
            this.position_from.lat = event.lat();
            this.position_from.lng = event.lng();
            console.log(event.lat(), event.lng())
        },
        setValue_to(value){
            this.value_to= value
        },
        setHow_to(value){
            this.how_to= value
        },
        gMapFunc_to(event) {
            this.position_to.lat = event.lat();
            this.position_to.lng = event.lng();
            console.log(event.lat(), event.lng())
        },
    }
});

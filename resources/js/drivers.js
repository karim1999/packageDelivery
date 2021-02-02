const app = new Vue({
    el: '#app',

    data() {
      return {
        messages: [{name:'lll',id:1},{name:'lll',id:1}],

      }
    },

    created() {

    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            axios.post('/messages', {
                message
            }).then(response => {
                this.messages.push({
                    message: response.data.message.message,
                    user: response.data.user
                });
            });
        },

        sendMessage() {
            this.addMessage(this.newMessage);
            this.newMessage = '';
        }
    }
});

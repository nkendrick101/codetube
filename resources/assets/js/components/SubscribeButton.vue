<template>
  <span v-if="canSubscribe && subscribers !== null">
    <button :class="userSubscribed ? 'btn btn-secondary m-btn m-btn--wide' : 'btn btn-danger m-btn m-btn--wide'" @click.prevent="handle()">
      {{ userSubscribed ? 'Unsubscribe' : 'Subscribe' }} &nbsp; {{ subscribers }}
    </button>
  </span>
  <span v-else-if="!canSubscribe && subscribers !== null">
    <button class="btn btn-danger m-btn m-btn--wide disabled">
      Subscribers &nbsp; {{ subscribers }}
    </button>
  </span>
</template>

<script>
  export default {
    data () {
      return {
        subscribers: null,
        userSubscribed: false,
        canSubscribe: false,
        token: document.getElementById('csrf-token').getAttribute('content'),
      }
    },

    props: {
      channelSlug: null
    },

    methods: {
      getSubscriptionStatus () {
        this.$http.get('/subscriptions/' + this.channelSlug).then((response) => {
          this.subscribers = response.body.count;
          this.userSubscribed = response.body.user_subscribed;
          this.canSubscribe = response.body.can_subscribe;
        });
      },

      handle () {
        if (this.userSubscribed) {
          this.unsubscribe();
        }
        else {
          this.subscribe();
        }
      },

      subscribe () {
        this.userSubscribed = true;
        this.subscribers++;
        this.$http.post('/subscription/' + this.channelSlug, {
          _token: this.token
        }); 
      },

      unsubscribe () {
        this.userSubscribed = false;
        this.subscribers--;
        this.$http.delete('/subscription/' + this.channelSlug, {
          body: {
            _token: this.token
          }
        }); 
      },
    },  

    mounted () {
      this.getSubscriptionStatus()
    }
  }
</script>

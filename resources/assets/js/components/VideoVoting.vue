<template>
  <span class="video__votes">
    <a href="#" :class="userVote == 'up' ? 'btn btn-primary m-btn m-btn--icon' : 'btn btn-secondary m-btn m-btn--icon'" @click.prevent="vote('up')">
      <span>
        <i class="la la-thumbs-up"></i>
        <span>
          {{ up }}
        </span>
      </span>
    </a>
    <span class="m--margin-right-5"></span>
    <a href="#" :class=" userVote == 'down' ? 'btn btn-danger m-btn m-btn--icon' : 'btn btn-secondary m-btn m-btn--icon'" @click.prevent="vote('down')">
      <span>
        <i class="la la-thumbs-down"></i>
        <span>
          {{ down }}
        </span>
      </span>
    </a>
  </span>
</template>

<script>
  export default {
    data () {
      return {
        up: null,
        down: null,
        canVote: false,
        userVote: null,
        token: document.getElementById('csrf-token').getAttribute('content')
      }
    },

    props: {
      videoUuid: null,
    },

    methods: {
      getVotes () {
        this.$http.get('/videos/' + this.videoUuid + '/votes').then((response) => {
          this.up = response.body.up;
          this.down = response.body.down;
          this.canVote = response.body.can_vote;
          this.userVote = response.body.user_vote;
        });
      },

      vote (type) {
        if (this.userVote == type) {
          this[type]--;
          this.userVote = null;
          this.deleteVote(type);
          return;
        }

        if (this.userVote) {
          this[type == 'up' ? 'down' : 'up']--;
        }

        this[type]++;
        this.userVote = type;
        this.createVote(type);
      },

      deleteVote (type) { 
        this.$http.delete('/videos/' + this.videoUuid + '/votes', {
          body: {
            _token: this.token
          }
        });
      },

      createVote (type) {
        this.$http.post('/videos/' + this.videoUuid + '/votes', {
          type: type,
          _token: this.token,
        });
      }
    },

    mounted () {
      this.getVotes()
    }
  }
</script>

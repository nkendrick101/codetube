<template>
  <plyr ref="player">
  <video>
    <source :src="videoUrl" type="video/webm"/>
  </video>
  </plyr>
</template>

<script>
import { Plyr } from "vue-plyr";
import "vue-plyr/dist/vue-plyr.css";

export default {
    components: {
        Plyr
    },

    data() {
        return {
            player: null,
            duration: null,
            token: document.getElementById("csrf-token").getAttribute("content")
        };
    },

    props: {
        videoUuid: null,
        videoUrl: null,
        thumbnailUrl: null
    },

    methods: {
        hasHitQuotaView() {
            if (!this.player.duration) {
                return false;
            }

            return (
                Math.round(this.player.currentTime) ===
                Math.round((10 * this.player.duration) / 100)
            );
        },

        createView() {
            this.$http.post("/videos/" + this.videoUuid + "/view", {
                _token: this.token
            });
        }
    },

    mounted() {
        this.player = this.$refs.player.player;

        setInterval(() => {
            if (this.hasHitQuotaView()) {
                this.createView();
            }
        }, 1000);
    }
};
</script>

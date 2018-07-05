<template>
    <div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair m--margin-top-35">
        <div class="m-portlet__head">
            <div class="align-items-center">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text" style="color: #6c757d;">
                            {{ pluralize(comments.length, 'comment') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__body" v-if="$root.user.authenticated">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img :src="userImage" alt="" class="d-flex mr-3 channel-img img-circle" style="width: 50px; height:auto;">
                    </a>
                </div>
                <div class="media-body">
                    <textarea placeholder="Add a public comment ..." class="form-control" rows="4" v-model="body"></textarea>
                    <div class="float-right m--margin-top-10">
                       <button type="submit" class="btn btn-sm btn-metal m-btn m-btn--wide" @click.prevent="createComment">Comment</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="m-portlet__body" style="border-top: 1px dashed #ebedf2; box-shadow: 0 1px 0 rgba(0,0,0,0.05) inset, 0 2px 0 rgba(0,0,0,0.1); padding: 0px;" v-else>
            <div class="alert m-alert--default m-alert--icon" style="margin-bottom:0; background-color: #f9fafa;">
                <div class="m-alert__icon">
                    <i class="flaticon-exclamation-2"></i>
                </div>
                <div class="m-alert__text">
                    Commenting on this video is only allowed for signed in members with active accounts. <br>
                    Please <a href="/login" class="m-link m-link--secondary">sign in</a> or <a href="/register" class="m-link m-link--secondary">sign up</a> to comment.
                </div>
            </div>
        </div>

        <div class="m-portlet__footer" style="padding: 1.5rem 1.5rem; border-top: 1px dashed #ebedf2;" v-if="comments.length">
            <div class="m-widget3">
                <div class="m-widget3__item" v-for="comment in comments">
                    <div class="m-widget3__header">
                        <div class="m-widget3__user-img">
                            <img class="m-widget3__img" :src="comment.channel.data.image" style="width: 50px; height:auto;">
                        </div>
                        <div class="m-widget3__info">
                            <span class="m-widget3__username">
                                {{ comment.channel.data.name }}
                            </span>
                            <br>
                            <span class="m-widget3__time">
                                {{ comment.created_at_human }}
                            </span>
                        </div>
                        <span class="m-widget3__status" v-if="$root.user.authenticated">
                            <a href="#" @click.prevent="toggleReplyForm(comment.id)" class="m-link m-link--focus">
                                {{ replyFormVisible === comment.id ? 'CANCEL' : 'REPLY' }}
                            </a>
                        </span>
                    </div>
                    <div class="m-widget3__body">
                        <p class="m-widget3__text">
                            {{ comment.body }}
                        </p>
                    </div>
                    <div class="media m--margin-top-35 m--margin-left-50" v-if="replyFormVisible === comment.id">
                        <div class="media-left">
                            <a href="#">
                                <img :src="userImage" alt="" class="d-flex mr-3 channel-img img-circle" style="width: 50px; height:auto;">
                            </a>
                        </div>
                        <div class="media-body">
                            <textarea placeholder="Add a reply ..." class="form-control" rows="4" v-model="replyBody"></textarea>
                            <div class="float-right m--margin-top-10 m--margin-bottom-10">
                               <button type="submit" class="btn btn-sm btn-metal m-btn m-btn--wide" @click.prevent="createReply(comment.id)">Reply</button>
                            </div>
                        </div>
                    </div>

                    <div class="m-widget3__item m--margin-left-50" v-for="reply in comment.replies.data">
                        <div class="m-widget3__header">
                            <div class="m-widget3__user-img">
                                <img class="m-widget3__img" :src="reply.channel.data.image" :alt="reply.channel.data.name + 'image'" style="width: 50px; height:auto;">
                            </div>
                            <div class="m-widget3__info">
                                <span class="m-widget3__username">
                                    {{ reply.channel.data.name }}
                                </span>
                                <br>
                                <span class="m-widget3__time">
                                    {{ reply.created_at_human }}
                                </span>
                            </div>
                        </div>
                        <div class="m-widget3__body">
                            <p class="m-widget3__text">
                                {{ reply.body }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		data () {
            return {
                comments: [],
                body: null,
                replyBody: null,
                replyFormVisible: null,
                editBody: null,
                editFormVisible: null,
                token: document.getElementById('csrf-token').getAttribute('content')
            }
        },

        props: {
            videoUuid: null,
            userImage: null
        },

        methods: {
            pluralize (count, word) {
                if (count == 0) {
                    return "0 " + word + "s";
                } 
                else if (count == 1) {
                    return "1 " + word;
                }

                return count + ' ' + word + 's';
            },

            getComments () {
                this.$http.get('/videos/' + this.videoUuid + '/comments').then((response) => {
                    this.comments = response.body.data;
                });
            },

            createComment () {
                this.$http.post('/videos/' + this.videoUuid + '/comment', {
                    body: this.body,
                    _token: this.token
                }).then((response) => {
                    this.comments.unshift(response.body.data);
                    this.body = null;
                });
            },

            createReply (commentId) {
                this.$http.post('/videos/' + this.videoUuid + '/comment', {
                    body: this.replyBody,
                    reply_id: commentId,
                    _token: this.token
                }).then((response) => {
                    this.comments.map((comment, index) => {
                        if (comment.id === commentId) {
                            this.comments[index].replies.data.push(response.body.data);
                        }
                    });
                    this.replyBody = null;
                    this.replyFormVisible = null;
                });
            }, 

            toggleReplyForm (commentId) {
                this.replyBody = null;
                
                if (this.replyFormVisible === commentId) {
                    this.replyFormVisible = null;
                    return;
                }

                this.replyFormVisible = commentId;
            },

            showConfirmationDialogue (isComment) {
                if (isComment) {
                    //$('#commentDeleteConfirmation').modal('show');
                    return;
                }
                //$('#replyDeleteConfirmation').modal('show');
            },

            deleteComment (commentId) {
                this.deleteById(commentId);
                this.$http.delete('/videos/' + this.videoUuid + '/comments/' + commentId, { body: { _token: this.token }});
            },

            deleteById (commentId) {
                this.comments.map((comment, index) => {
                    if (comment.id === commentId) {
                        this.comments.splice(index, 1);
                        return;
                    }

                    comment.replies.data.map((reply, replyIndex) => {
                        if (reply.id === commentId) {
                            this.comments[index].replies.data.splice(replyIndex, 1);
                            return;
                        }   
                    }); 
                });
            },             
        },

		mounted () {
            this.getComments();
		}
	}
</script>
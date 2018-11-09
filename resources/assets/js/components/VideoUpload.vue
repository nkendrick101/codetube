<template>
  <div id="upload-video-modal" class="modal fade">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="m-portlet m-portlet--full-height">
          <div class="m-portlet__head" style="padding: 0 20px 0 20px; height: 4.0rem;">
            <div class="m-portlet__head-caption">
              <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                  Upload
                </h3>
              </div>
            </div>
            <div class="m-portlet__head-tools">
              <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item m-portlet__nav-item--last">
                  <a id="addNewVideo" href="#" class="btn btn-sm btn-focus m-btn m-btn--wide m-btn--pill m-btn--air m-btn--custom m-btn--bolder">
                    UPLOAD
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div class="m-portlet__body" style="padding: 0px;">
            <vue-dropzone 
              id="dropzoneVideo" 
              ref="dropzoneVideo"
              :options="dropzoneOptions"
              @vdropzone-error="errorEvent"
              @vdropzone-sending="sendingEvent"
              @vdropzone-file-added="fileAddedEvent"
              @vdropzone-success="uploadCompleteEvent"
              @vdropzone-upload-progress="updateProgressEvent"
            >
            </vue-dropzone>
          </div>    

          <div class="m-portlet__foot">
            <div v-if="uploading && !failed">
              <div class="m-portlet__body">
                <div class="row">
                  <div class="col-form-label col-lg-2 col-sm-12"></div>
                  <div class="col-lg-10 col-md-12 col-sm-12">
                    <div class="alert alert-focus" v-if="!uploadingComplete">
                      Your video will be available at&nbsp;
                      <a :href="$root.url + '/videos/' + uuid" class="m-link m-link--light">
                        <strong>{{ $root.url }}/videos/{{ uuid }}</strong>
                      </a>.
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-form-label col-lg-2 col-sm-12"></div>
                  <div class="col-lg-10 col-md-12 col-sm-12">
                    <div class="alert alert-success" v-if="uploadingComplete">
                      Upload complete. Video is now processing and will shortly be available 
                      <a :href="$root.url + '/videos/' + uuid" class="m-link m-link--light">
                        <strong>here</strong>
                      </a>.
                    </div>
                  </div>
                </div>

                <div class="form-group m-form__group row m--margin-top-25">
                  <label class="col-form-label col-lg-2 col-sm-12">
                    Title
                  </label>
                  <div class="col-lg-10 col-md-12 col-sm-12">
                    <input class="form-control m-input" type="text" v-model="title" autofocus>
                  </div>
                </div>

                <div class="form-group m-form__group row">
                  <label class="col-form-label col-lg-2 col-sm-12">
                    Visibility
                  </label>
                  <div class="col-lg-10 col-md-12 col-sm-12">
                    <select id="visibility" class="form-control m-input" v-model="visibility">
                      <option value="public">Public</option>
                      <option value="private">Private</option>
                      <option value="unlisted">Unlisted</option>
                    </select>
                  </div>
                </div>

                <div class="form-group m-form__group row">
                  <label class="col-form-label col-lg-2 col-sm-12">
                    Description
                  </label>
                  <div class="col-lg-10 col-md-12 col-sm-12">
                    <textarea class="form-control m-input" v-model="description"></textarea>
                  </div>
                </div>
              </div>

              <div class="m-portlet__foot">
                <div class="m-form__actions">
                  <div class="row">
                    <div class="col-lg-2 col-sm-12"></div>
                    <div class="col-lg-10 col-md-12 col-sm-12">
                      <button type="submit" class="btn btn-sm btn-focus m-btn m-btn--custom m-btn--wide m-btn--icon m-btn--air" @click.prevent="update">
                        Save changes
                      </button>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <span class="help-block">{{ status }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Selectize from "vue2-selectize";
import vue2Dropzone from "vue2-dropzone";

export default {
    components: {
        vueDropzone: vue2Dropzone,
        Selectize
    },
    data() {
        return {
            uuid: null,
            uploading: false,
            uploadingComplete: false,
            failed: false,
            title: "Untitled",
            description: null,
            visibility: "public",
            status: null,
            fileProgress: 0,
            error: null,
            token: document
                .getElementById("csrf-token")
                .getAttribute("content"),

            dropzoneOptions: {
                method: "POST",
                url: "/upload-video",
                maxFiles: 1,
                maxFilesize: 100,
                paramName: "video",
                filesizeBase: 1024,
                autoProcessQueue: false,
                chunking: true,
                retryChunks: true,
                retryChunksLimit: 2,
                headers: { "X-CSRF-Token": this.token },
                clickable: ["#addNewVideo", "#dropzoneVideo"],
                dictMaxFilesExceeded:
                    "Maximum number of files has been exceeded!",
                dictInvalidFileType: "Unsupported file extension!",
                dictFileTooBig: "File size exceeds 5MB!",
                acceptedFiles: "video/*",
                dictDefaultMessage:
                    '<i class="flaticon-multimedia-1" style="font-weight: 500; font-size: 65px;"></i> <br> <span style="font-size: 20px;">Drop Your Video Here or Click to Upload</span> <br> <span class="note needsclick" style="font-size: 14px;">Drag and drop anywhere you want and start uploading your content today.</span>'
            }
        };
    },

    methods: {
        fileAddedEvent(file) {
            this.store(file).then(() => {
                this.$refs.dropzoneVideo.processQueue();
                this.uploading = true;
                this.failed = false;
            });
        },
        sendingEvent(file, xhr, form) {
            form.append("uuid", this.uuid);
        },
        updateProgressEvent(file, progress, bytesSent) {
            this.fileProgress = progress;
        },
        uploadCompleteEvent(file, response) {
            this.uploadingComplete = true;
            this.failed = false;
        },
        errorEvent(file, message, xhr) {
            this.uploading = false;
            this.failed = true;
            this.error = message;
            this.$http.delete("/videos/" + this.uuid, {
                body: { _token: this.token }
            });
        },
        store(file) {
            return this.$http
                .post("/videos", {
                    title: this.title,
                    description: this.description,
                    visibility: this.visibility,
                    extension: file.name.split(".").pop(),
                    _token: this.token
                })
                .then(response => {
                    this.uuid = response.data.uuid;
                });
        },
        update() {
            this.status = "Saving changes";

            return this.$http
                .put("/videos/" + this.uuid, {
                    title: this.title,
                    description: this.description,
                    visibility: this.visibility,
                    _token: this.token
                })
                .then(response => {
                    this.status = "Changes saved";

                    setTimeout(() => (this.status = null), 3000);
                })
                .catch(() => {
                    this.status = "Failed to save changes";
                });
        }
    },

    mounted() {
        window.onbeforeunload = () => {
            if (this.uploading && !this.uploadingComplete && !this.failed) {
                return "Are you sure you want to navigate away?";
            }
        };
    }
};
</script>

<style>
#dropzoneVideo {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -ms-border-radius: 4px;
    -o-border-radius: 4px;
    border-radius: 4px;
    padding: 80px;
    background: transparent;
    text-align: center;
    cursor: pointer;
}

#dropzoneVideo .dz-message {
    margin: 0 0 5px 0;
    padding: 0;
    font-weight: 500;
    font-size: 1.1rem;
}
#dropzoneVideo .note {
    font-size: 0.85rem;
    font-weight: 500;
}
#dropzoneVideo .dz-preview .dz-image {
    border-radius: 20px;
    overflow: hidden;
    width: 120px;
    height: 120px;
    position: relative;
    display: block;
    z-index: 10;
}
#dropzoneVideo {
    border: none;
}
#dropzoneVideo .dz-message {
    color: #a26ff9;
}
#dropzoneVideo .note {
    color: #a26ff9;
}
#dropzoneVideo:hover,
#dropzoneVideo .dz-drag-hover .dz-message {
    opacity: 0.7;
}
#dropzoneVideo .dz-preview .dz-error-message {
    margin-top: 20px;
}
.dropzoneVideo .dz-preview .dz-remove {
    margin-top: 5px;
}
</style>

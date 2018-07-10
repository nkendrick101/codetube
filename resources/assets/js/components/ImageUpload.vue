<template>
    <div id="upload-image-modal" class="modal fade">
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
                                    <a id="addNewImage" href="#" class="btn btn-sm btn-focus m-btn m-btn--wide m-btn--pill m-btn--air m-btn--custom m-btn--bolder">
                                        UPLOAD
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="m-portlet__body" style="padding: 0px;">
                        <vue-dropzone 
                        	id="dropzoneImage" 
                        	ref="dropzoneImage"
                            :options="dropzoneOptions"
                            @vdropzone-error="errorEvent"
                            @vdropzone-sending="sendingEvent"
                            @vdropzone-success="uploadSuccessEvent"
                            @vdropzone-upload-progress="updateProgressEvent"
                        >
                        </vue-dropzone>
                    </div>

                    <div class="m-portlet__foot"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone';

	export default {
		components: {
    		vueDropzone: vue2Dropzone,
  		},

  		data () {
  			return {
  				dropzoneOptions: {
              		method: 'POST',
              		url: '/upload-image',
              		maxFiles: 1,
              		maxFilesize: 2,
              		paramName: 'image',
              		filesizeBase: 1024,
                    autoProcessQueue: true,
                    chunking: true,
                    retryChunks: true,
                    retryChunksLimit: 2,
              		headers: { 'X-CSRF-Token': this.token },
              		clickable: ['#addNewImage', '#dropzoneImage'],
              		dictMaxFilesExceeded: 'Maximum number of files has been exceeded!',
    				dictInvalidFileType: 'Unsupported file extension!',
    				dictFileTooBig: 'File size exceeds 2MB!',
    				acceptedFiles: 'image/*',
            		dictDefaultMessage: '<i class="flaticon-multimedia-1" style="font-weight: 300; font-size: 65px; opacity: .5;"></i> <br> Drop an Image or Click to Upload <br> <span class="note needsclick">Drag and drop anywhere you want and start uploading your channel image.</span>'
          		}
  			}
        },

        methods: {
            errorEvent () {
                return;
            },

            sendingEvent () {
                $('#upload-image-modal').modal('toggle');
            },

            uploadSuccessEvent (file, response) {
                $('#progress-bar--parent').addClass('m--hide');
                $('.img-link').each(function() { $(this).attr('src', response.url); });
                this.$refs.dropzoneImage.removeAllFiles();
            },

            updateProgressEvent (file, progress, bytesSent) {
                $('#progress-bar--parent').removeClass('m--hide');
                $('#progress-bar').attr('style', 'width:' + progress + '%; height: 5px;');
            }
        }
	}
</script>

<style>
	#dropzoneImage {
  		-webkit-border-radius: 4px;
  		-moz-border-radius: 4px;
  		-ms-border-radius: 4px;
  		-o-border-radius: 4px;
  		border-radius: 4px;
  		padding: 40px;
  		background: transparent;
  		text-align: center;
  		cursor: pointer; 
  	}

  	#dropzoneImage .dz-message {
    	margin: 0 0 5px 0;
    	padding: 0;
    	font-weight: 100;
    	font-size: 1.1rem; 
   }
  	#dropzoneImage .note {
    	font-size: 0.85rem;
    	font-weight: 300; 
   }
  	#dropzoneImage .dz-preview .dz-image {
    	border-radius: 20px;
        overflow: hidden;
        width: 120px;
        height: 120px;
        position: relative;
        display: block;
        z-index: 10;
   }
	#dropzoneImage {
  		border: none;
	}	
  	#dropzoneImage .dz-message {
    	color: #6f727d; 
   }
  	#dropzoneImage .note {
    	color: #6f727d; 
   }
   #dropzoneImage:hover,
   #dropzoneImage .dz-drag-hover .dz-message {
   	    opacity: .7;
	}
    #dropzoneImage .dz-preview .dz-error-message {
        margin-top: 20px;
    }
    .dropzoneImage .dz-preview .dz-remove {
        margin-top: 5px;
    }
</style>
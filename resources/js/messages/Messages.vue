<template>
    <div id="messages">

        <v-expand-transition>
            <div v-if="progress">
                <v-progress-linear indeterminate color="primary"></v-progress-linear>
            </div>    
        </v-expand-transition>

        <v-expand-transition>
            <div v-if="alertWarning.enable">
                <v-alert class="mx-auto" text prominent type="warning" icon="mdi-alert">
                    <b>{{ alertWarning.title }}</b> <br> 
                    {{ alertWarning.content }}
                </v-alert>
            </div>
        </v-expand-transition>

        <v-expand-transition>
            <div v-if="alertError.enable">
                <v-alert class="mx-auto" text prominent type="error" icon="mdi-alert">
                    <b>{{ alertError.title }}</b> <br> 
                    {{ alertError.content }}
                </v-alert>
            </div>
        </v-expand-transition>

        <v-expand-transition>
            <div v-if="alertSuccess.enable">
                <v-alert class="mx-4" text prominent type="success" icon="mdi-alert">
                    <b>{{ alertSuccess.title }}</b> <br> 
                    {{ alertSuccess.content }}
                </v-alert>
        
            </div>
        </v-expand-transition>

    </div>
</template>

<script>
export default {
    props: ['progress'],
    data() {
        return {
            alertError: {
				enable: false,
				title: '',
				content: '',
			},
			alertSuccess: {
				enable: false,
				title: '',
				content: '',
			},
			alertWarning: {
				enable: false,
				title: '',
				content: '',
			},
        }
    },
    methods: {
        showAlertSuccess(title, message) 
	    {
	        this.alertSuccess.enable = true
			this.alertSuccess.title = title
			this.alertSuccess.content = message
    	    setTimeout(() => {
    			this.alertSuccess.enable = false;
    		}, 4000);
	    },

	    showAlertError(title, message)
	    {
    		this.alertError.enable = true;
    		this.alertError.title = title
    		this.alertError.content = message
    		setTimeout(() => {
    			this.alertError.enable = false;
    		}, 4000);
	    },

	    showAlertWarning(title, message)
	    {
    		this.alertWarning.enable = true;
    		this.alertWarning.title = title
    		this.alertWarning.content = message
    		setTimeout(() => {
    			this.alertWarning.enable = false;
    		}, 4000);
	    }
    }
}
</script>
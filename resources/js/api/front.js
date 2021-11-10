import axios from 'axios';

axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default {

    showFront(data) {
        return axios.post('/api/show-front', data);
    },

	store(data){
		let formData = this.jsonToFormData(data);

		return axios.post('/api/store-front',
			formData,
			{ 
				headers: {
					'Content-Type': 'multipart/form-data'
				}
			},	
		);
	},
    
    buildFormData(formData, data, parentKey) {
		if (data && typeof data === 'object' && !(data instanceof Date) && !(data instanceof File)) {
		  Object.keys(data).forEach(key => {
			this.buildFormData(formData, data[key], parentKey ? `${parentKey}[${key}]` : key);
		  });
		} else {
		  const value = data == null ? '' : data;
	  
		  formData.append(parentKey, value);
		}
	},


    jsonToFormData(data) {
		const formData = new FormData();
		
		this.buildFormData(formData, data);
		
		return formData;
	}

}

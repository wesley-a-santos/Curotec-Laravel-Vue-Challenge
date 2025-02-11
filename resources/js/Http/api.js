import axios from "axios";

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const api = axios.create({
    baseURL: 'http://127.0.0.1',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
});

export default api

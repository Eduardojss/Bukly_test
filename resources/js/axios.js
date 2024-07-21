import axios from "axios";
let token = localStorage.getItem("token");
axios.defaults.baseURL = "http://127.0.0.1:80";
    if (localStorage.getItem("token")) {
      axios.defaults.headers.common["Authorization"] = "Bearer " + token;
    } else {
      axios.defaults.headers.common["Authorization"] = null;
    }
export default axios;
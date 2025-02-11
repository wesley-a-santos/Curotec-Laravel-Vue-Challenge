import api from "@/Http/api";

export const csrfCookie = () => api.get('/sanctum/csrf-cookie');

export const login = (credentials) => api.post('api/auth/login', credentials);

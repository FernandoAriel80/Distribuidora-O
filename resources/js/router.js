export default {
    home: '/',
    auth: {
        login: '/login',
        register: '/register',
        logout: '/logout',
    },
    admin: {
        menu: '/admin',
    },
    products: {
        index: '/admin/products',
        create: '/admin/products/create',
        show: (id) => `/admin/products/${id}`,
    },
};

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
        edit: (id) => `/admin/products/edit/${id}`,
        update: (id) =>`/admin/products/edit/${id}`,
        delete:(id) => `/admin/products/${id}`,
    },
};

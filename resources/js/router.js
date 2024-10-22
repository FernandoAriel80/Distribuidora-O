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
        update: (id) => `/admin/products/update/${id}`,
        delete:(id) => `/admin/products/${id}`,
    },
    employees:{
        index:'/admin/employees',
        create:'/admin/employees/create',
        update:(id) => `/admin/employees/update/${id}`,
        delete:(id) => `/admin/employees/${id}`,
    },
    cart:{
        index:'/cart',
        create:(id)=>`/cart/create/${id}`,
        delete:(id,type) => `/cart/${id,type}`,
    }
};

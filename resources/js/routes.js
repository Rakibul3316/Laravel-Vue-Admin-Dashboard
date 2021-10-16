import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import Forget from './components/auth/Forget.vue';
import Logout from './components/auth/Logout.vue';
import Home from './components/home.vue';

// Employee Componets
import AddEmployee from './components/employee/create.vue';
import AllEmployee from './components/employee/index.vue';
import EditEmployee from './components/employee/edit.vue';

// Supplier Components
import AddSupplier from './components/suppliers/create.vue';
import AllSupplier from './components/suppliers/index.vue';
import EditSupplier from './components/suppliers/edit.vue';

// Catagory Components
import AddCategory from './components/category/create.vue';
import AllCategory from './components/category/index.vue';
import EditCategory from './components/category/edit.vue';

// Product Components
import AddProduct from './components/product/create.vue';
import AllProduct from './components/product/index.vue';
import EditProduct from './components/product/edit.vue';

// Product Components
import AddExpense from './components/expense/create.vue';
import AllExpense from './components/expense/index.vue';
import EditExpense from './components/expense/edit.vue';

// Salary Components
import Salary from './components/salary/all_employee.vue';
import PaySalary from './components/salary/create.vue';
import AllSalary from './components/salary/index.vue';
import ViewSalary from './components/salary/view.vue';
import EditSalary from './components/salary/edit.vue';

// Product Components
import Stock from './components/product/stock.vue';
import EditStock from './components/product/edit-stock.vue';

// Product Components
import AddCustomer from './components/customer/create.vue';
import AllCustomer from './components/customer/index.vue';
import EditCustomer from './components/customer/edit.vue';

// POS Components
import POS from './components/pos/pointofsale.vue';

// Order Components
import Order from './components/order/order.vue';
import ViewOrder from './components/order/view-order.vue';
import SearchOrder from './components/order/search.vue';


export const routes = [
    { path: '/', component: Login, name: '/' },
    { path: '/logout', component: Logout, name: 'logout' },
    { path: '/register', component: Register },
    { path: '/forget', component: Forget },
    { path: '/home', component: Home, name: 'home' },

    // Employee Routes
    { path: '/store-employee', component: AddEmployee, name: 'store-employee' },
    { path: '/employee', component: AllEmployee, name: 'employee' },
    { path: '/edit-employee/:id', component: EditEmployee, name: 'edit-employee' },

    // Supplier Routes
    { path: '/store-supplier', component: AddSupplier, name: 'store-supplier' },
    { path: '/supplier', component: AllSupplier, name: 'supplier' },
    { path: '/edit-supplier/:id', component: EditSupplier, name: 'edit-supplier' },

    // Category Routes
    { path: '/store-category', component: AddCategory, name: 'store-category' },
    { path: '/category', component: AllCategory, name: 'category' },
    { path: '/edit-category/:id', component: EditCategory, name: 'edit-category' },

    // Product Routes
    { path: '/store-product', component: AddProduct, name: 'store-product' },
    { path: '/product', component: AllProduct, name: 'product' },
    { path: '/edit-product/:id', component: EditProduct, name: 'edit-product' },

    // Expense Routes
    { path: '/store-expense', component: AddExpense, name: 'store-expense' },
    { path: '/expense', component: AllExpense, name: 'expense' },
    { path: '/edit-expense/:id', component: EditExpense, name: 'edit-expense' },

    // Salary Routes
    { path: '/given-salary', component: Salary, name: 'given-salary' },
    { path: '/salary', component: AllSalary, name: 'salary' },
    { path: '/pay-salary/:id', component: PaySalary, name: 'pay-salary' },
    { path: '/view-salary/:id', component: ViewSalary, name: 'view-salary' },
    { path: '/edit-salary/:id', component: EditSalary, name: 'edit-salary' },

    // Stock Routes
    { path: '/stock', component: Stock, name: 'stock' },
    { path: '/edit-stock/:id', component: EditStock, name: 'edit-stock' },

    // Product Routes
    { path: '/store-customer', component: AddCustomer, name: 'store-customer' },
    { path: '/customer', component: AllCustomer, name: 'customer' },
    { path: '/edit-customer/:id', component: EditCustomer, name: 'edit-customer' },

    // POS Routes
    { path: '/pos', component: POS, name: 'pos' },

    // Order Routes
    { path: '/order', component: Order, name: 'order' },
    { path: '/view-order/:id', component: ViewOrder, name: 'view-order' },
    { path: '/searchorder', component: SearchOrder, name: 'searchorder' },
]
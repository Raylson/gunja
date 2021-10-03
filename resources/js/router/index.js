import Vue from 'vue'
import Router from 'vue-router'

const AdminLayout = () => import('../components/admin/modules/AdminLayout')
const Dashboard = () => import('../components/admin/Dashboard')
const SiteSetting = () => import('../components/admin/SiteSetting')

// Users
const Users = () => import('../components/admin/users/Users')
const User = () => import('../components/admin/users/User')
const EditUser = () => import('../components/admin/users/EditUser')
const CreateUser = () => import('../components/admin/users/CreateUser')

// Categories
const Categories = () => import('../components/admin/category/Categories')
const EditCategory = () => import('../components/admin/category/EditCategory')
const CreateCategory = () => import('../components/admin/category/CreateCategory')

// Sub Categories
const SubCategories = () => import('../components/admin/sub-category/SubCategories')
const EditSubCategory = () => import('../components/admin/sub-category/EditSubCategory')
const CreateSubCategory = () => import('../components/admin/sub-category/CreateSubCategory')

// Questions
const Questions = () => import('../components/admin/question/Questions')
const EditQuestion = () => import('../components/admin/question/EditQuestion')
const CreateQuestion = () => import('../components/admin/question/CreateQuestion')

// Examiners
const Examiners = () => import('../components/admin/examiner/Examiners')
const ExaminerDetail = () => import('../components/admin/examiner/ExaminerDetail')
const ExamStepOne = () => import('../components/pages/ExamStepOne')
const ExamNow = () => import('../components/pages/ExamNow')

const UserLayout = () => import('../components/pages/UserLayout')
const ExaminerList = () => import('../components/pages/ExaminerList')
const UserExaminerDetail = () => import('../components/pages/UserExaminerDetail')

// Views - Pages
const FrontendLogin = () => import('../components/admin/pages/FrontendLogin')
const Register = () => import('../components/admin/pages/Register')
const PasswordReset = () => import('../components/admin/pages/PasswordReset')
const PasswordResetToken = () => import('../components/admin/pages/PasswordResetToken')
const Login = () => import('../components/admin/pages/Login')
const Page404 = () => import('../components/admin/pages/Page404')
const Page500 = () => import('../components/admin/pages/Page500')

Vue.use(Router)

export default new Router({
  mode: 'history', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes()
})

function configRoutes() {
  return [
    {
      path: '/admin',
      // redirect: '/admin/dashboard',
      name: 'Admin',
      component: AdminLayout,
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },
        {
          path: 'settings',
          name: 'SiteSetting',
          component: SiteSetting,
        },
        {
          path: 'users',
          meta: { label: 'Users' },
          component: {
            render(c) { return c('router-view') }
          },
          children: [
            {
              path: '/',
              name: 'Users',
              component: Users,
            },
            {
              path: 'create',
              meta: { label: 'Create User' },
              name: 'Create User',
              component: CreateUser
            },
            {
              path: ':id',
              meta: { label: 'User Details' },
              name: 'User',
              component: User,
            },
            {
              path: ':id/edit',
              meta: { label: 'Edit User' },
              name: 'Edit User',
              component: EditUser
            }
          ]
        },
        {
          path: 'categories',
          meta: { label: 'Categories' },
          component: {
            render(c) { return c('router-view') }
          },
          children: [
            {
              path: '/',
              name: 'Categories',
              component: Categories,
            },
            {
              path: 'create',
              meta: { label: 'Create Category' },
              name: 'Create Category',
              component: CreateCategory
            },
            {
              path: ':id/edit',
              meta: { label: 'Edit Category' },
              name: 'Edit Category',
              component: EditCategory
            }
          ]
        },
        {
          path: 'sub-categories',
          meta: { label: 'Sub Categories' },
          component: {
            render(c) { return c('router-view') }
          },
          children: [
            {
              path: '/',
              name: 'SubCategories',
              component: SubCategories,
            },
            {
              path: 'create',
              meta: { label: 'Create SubCategory' },
              name: 'Create SubCategory',
              component: CreateSubCategory
            },
            {
              path: ':id/edit',
              meta: { label: 'Edit SubCategory' },
              name: 'Edit SubCategory',
              component: EditSubCategory
            }
          ]
        },
        {
          path: 'questions',
          meta: { label: 'Questions' },
          component: {
            render(c) { return c('router-view') }
          },
          children: [
            {
              path: '/',
              name: 'Questions',
              component: Questions,
            },
            {
              path: 'create',
              meta: { label: 'Create Question' },
              name: 'Create Question',
              component: CreateQuestion
            },
            {
              path: ':id/edit',
              meta: { label: 'Edit Question' },
              name: 'Edit Question',
              component: EditQuestion
            }
          ]
        },
        {
          path: 'examiners',
          meta: { label: 'Examiners' },
          component: {
            render(c) { return c('router-view') }
          },
          children: [
            {
              path: '/',
              name: 'Examiners',
              component: Examiners,
            },
            {
              path: ':id/',
              meta: { label: 'Examiner Detail' },
              name: 'Examiner Detail',
              component: ExaminerDetail
            }
          ]
        },
      ]
    },
    {
      path: '/login',
      name: 'FrontendLogin',
      component: FrontendLogin,
    },
    {
      path: '/password/reset',
      name: 'PasswordReset',
      component: PasswordReset,
    },
    {
      path: '/password/reset/:token',
      name: 'PasswordResetToken',
      component: PasswordResetToken,
    },
    {
      path: '/admin/login',
      name: 'Login',
      component: Login,
    },
    {
      path: '/exam/step-one',
      name: 'ExamStepOne',
      component: ExamStepOne,
    },
    {
      path: '/exam-now/:uniqueKey',
      name: 'ExamNow',
      component: ExamNow,
    },
    {
      path: '/examiners',
      name: 'User Examiners',
      component: UserLayout,
      children: [
        {
          path: 'list',
          name: 'ExaminerList',
          component: ExaminerList
        },
        {
          path: ':id/',
          meta: { label: 'Examiner Detail' },
          name: 'User Examiner Detail',
          component: UserExaminerDetail
        }
      ]
    },
    {
      path: '*',
      name: '404',
      component: Page404
    }
  ]
}

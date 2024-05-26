import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import loginForm from '../components/loginForm.vue'
import SignupForm from '../components/SignupForm.vue'
import AproposVue from '../components/AproposVue.vue'
import ProgrammationVue from '../components/ProgrammationVue.vue'
import chessVue from '../components/chessVue.vue'
import RobotiqueVue from '../components/RobotiqueVue.vue'
import AiVue from '../components/AiVue.vue'
import LabVue from '../components/LabVue.vue'
import ElectroVue from '../components/ElectroVue.vue'
import ContactVue from '../components/ContactVue.vue'
import AdminVue from '../views/AdminVue.vue'
import offreVue from '../components/AdminSpace/offreVue.vue'
import ActiviteVue from '../components/AdminSpace/ActiviteVue.vue'
import AddOffre from '../components/AdminSpace/AddOffre.vue'
import AddActivite from '../components/AdminSpace/AddActivite.vue'
import ForgetPass from '../components/ForgetPass.vue'
import verifyEmail from '../components/verifyEmail.vue'
import showActivite from '../components/AdminSpace/showActivite.vue'
import showOffre from '../components/AdminSpace/showOffre.vue'
const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomeView
  },
  {
    path: '/loginForm',
    name: 'loginForm',
    component: loginForm
  },
  {
    path: '/SignupForm',
    name: 'SignupForm',
    component: SignupForm
  },
  {
    path: '/AproposVue',
    name: 'AproposVue',
    component: AproposVue
  },
  {
    path: '/ProgrammationVue',
    name: 'ProgrammationVue',
    component: ProgrammationVue
  },
  {
    path: '/chessVue',
    name: 'chessVue',
    component: chessVue
  },
  {
    path: '/RobotiqueVue',
    name: 'RobotiqueVue',
    component: RobotiqueVue
  },
  {
    path: '/AiVue',
    name: 'AiVue',
    component: AiVue
  },
  {
    path: '/LabVue',
    name: 'LabVue',
    component: LabVue
  },
  {
    path: '/ElectroVue',
    name: 'ElectroVue',
    component: ElectroVue
  },
  {
    path: '/ContactVue',
    name: 'ContactVue',
    component: ContactVue
  },
  {
    path: '/ForgetPass',
    name: 'ForgetPass',
    component: ForgetPass
  },
  {
    path: '/verifyEmail',
    name: 'verifyEmail',
    component: verifyEmail
  },
  {
    path: '/AdminVue',
    name: 'AdminVue',
    component: AdminVue,
    children: [
      {
          path: 'offreVue',
          name: 'offreVue',
          component: offreVue
      },
      {
        path: 'ActiviteVue',
        name: 'ActiviteVue',
        component: ActiviteVue
    },
    {
      path: 'AddOffre',
      name: 'AddOffre',
      component: AddOffre
  },
  {
    path: 'showActivite/:id',
    name: 'showActivite',
    component: showActivite
},
{
  path: 'showOffre/:offreId',
  name: 'showOffre',
  component: showOffre
},
  {
    path: 'AddActivite',
    name: 'AddActivite',
    component: AddActivite
},
    ]
  },
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router


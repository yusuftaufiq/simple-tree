import alpinejs from 'alpinejs';
import axios from 'axios';
import familyTreeComponent from './views/home/components/family-tree-component';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Alpine = alpinejs;
window.Alpine.data('familyTreeComponent', familyTreeComponent);
window.Alpine.start();

import { AlpineComponent } from 'alpinejs';
import { Person } from '../types/person.type';
import { buildTree } from '../utils/build-tree';
import { buildMenuHTML } from '../utils/build-menu-html';

interface Component {
  tableMenuOpened: boolean;
  treeMenuOpened: boolean;

  persons: Person[];

  searchPersonKeyword: string;
  selectedPerson: null | Person;

  filterFamilyTreeByParent: null | string;
}

export default (): AlpineComponent<Component> => ({
  tableMenuOpened: true,
  treeMenuOpened: false,

  persons: [],

  searchPersonKeyword: '',
  selectedPerson: null,

  filterFamilyTreeByParent: null,

  isLoading: false,

  get filteredPersons() {
    return this.persons.filter(({ name, gender }) => {
      const keyword = this.searchPersonKeyword.toLowerCase();

      return (
        name.toLowerCase().includes(keyword) ||
        gender.toLowerCase().includes(keyword)
      );
    });
  },

  get treePersonsHTML() {
    const parentId = Number(this.filterFamilyTreeByParent);
    const persons = buildTree(this.persons, parentId !== 0 ? parentId : null);

    return buildMenuHTML(persons);
  },
});

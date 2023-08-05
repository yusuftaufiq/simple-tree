import { PersonTree } from '../types/person-tree.type';

export function buildMenuHTML(persons: PersonTree[]): string {
  return persons.reduce((html, person) => {
    if (person.children.length > 0) {
      return `${html}
        <li>
          <details open>
            <summary>
              ${person.name}
              <span class="badge badge-sm ${
                person.gender === 'MALE' ? 'badge-info' : 'badge-error'
              }">${person.gender}</span>
            </summary>
            <ul>${buildMenuHTML(person.children)}</ul>
          </details>
        </li>`;
    }

    return `${html}
      <li>
        <a>
          ${person.name}
          <span class="badge badge-sm ${
            person.gender === 'MALE' ? 'badge-info' : 'badge-error'
          }">${person.gender}</span>
        </a>
      </li>`;
  }, '');
}

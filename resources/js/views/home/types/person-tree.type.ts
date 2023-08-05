import { Person } from './person.type';

export interface PersonTree extends Person {
  children: PersonTree[];
}

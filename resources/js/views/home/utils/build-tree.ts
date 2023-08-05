import { PersonTree } from '../types/person-tree.type';
import { Person } from '../types/person.type';

export function buildTree(
  data: Person[],
  parentId: number | null = null,
): PersonTree[] {
  return data
    .filter((item) => item.parentId === parentId)
    .map((item) => ({
      ...item,
      children: buildTree(data, item.id),
    }));
}

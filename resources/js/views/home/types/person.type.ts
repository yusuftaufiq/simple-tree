export interface Person {
  id: number;
  parentId: number | null;
  name: string;
  gender: 'MALE' | 'FEMALE';
}

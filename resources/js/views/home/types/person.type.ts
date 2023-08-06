export interface Person {
  id: number;
  parent_id: number | null;
  name: string;
  gender: 'MALE' | 'FEMALE';
}

export const product1 = {
  id: 11,
  brand: 'SAELEN',
  shortDescription: 'D21 avec bac de ramassage et bennage en hauteur',
  picture: '/build/img/005.jpg',
  reference: '12WA24B',
  stock: {
    quantity: 0,
    state: 'restocking',
  },
  price: {
    current: 432100,
    recommended: 432100,
  },
  discount: undefined,
};

export const product2 = {
  id: 12,
  brand: 'SAELEN',
  shortDescription: 'Pièces de rechange pour D21 avec bac de ramassage et bennage en hauteur',
  picture: '/build/img/006.jpg',
  reference: '202469',
  stock: {
    quantity: 12,
    state: 'stock',
  },
  price: {
    current: 388800,
    recommended: 432100,
  },
  discount: 10,
};

export const product3 = {
  id: 13,
  brand: 'SAELEN',
  shortDescription: 'Produit d\'entretien pour bac de ramassage sur D21',
  picture: '/build/img/001.jpg',
  reference: '45679D',
  stock: {
    quantity: 0,
    state: 'stockOut',
  },
  price: {
    current: 49000,
    recommended: 55000,
  },
  discount: undefined,
};

const availableProducts:Product[] = [product1, product2, product3];

export const findProductByRef = (ref: string): Product|undefined => {
  return availableProducts.find((product) => product.reference == ref);
};

export const findProductById = (id: number): Product|undefined => {
  return availableProducts.find((product) => product.id == id);
};

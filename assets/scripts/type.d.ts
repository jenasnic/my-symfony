declare module '*.module.scss' {
    const classes: { readonly [key: string]: string };
    export default classes;
}

type Product = {
    id: number,
    brand: string,
    shortDescription: string,
    picture: string,
    reference: string,
    stock: {
        quantity: number,
        state: string,
    },
    price: {
        current: number,
        recommended: number,
    },
    discount: number|undefined,
};

type CartItem = {
    product: Product,
    quantity: number,
}

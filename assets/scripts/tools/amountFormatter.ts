const formatter = new Intl.NumberFormat('fr-FR', {
  style: 'decimal',
  minimumFractionDigits: 2,
  maximumFractionDigits: 2
});

export const formatAmount = (amount: number) => {
  return formatter.format(amount / 100);
};

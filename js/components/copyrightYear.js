export const copyrightYear = () => {
    const currentYear = new Date().getFullYear();
    const madeInYear = 2020;
    return currentYear > madeInYear ? `${madeInYear}-${currentYear}` : currentYear;
};
export default {
    price(price) {
        return price.toLocaleString("pt-BR", {
          style: "currency",
          currency: "BRL",
        });
      },
}
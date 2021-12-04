// axiosを使用したgoogleAPI使用のため
// local環境の場合

// module.exports = {
//     devServer: {
//         proxy: 'https://maps.googleapis.com/guest#/plan',
//     }
// };


// module.exports = {
//     configureWebpack: {
//         devServer: {
//             proxy: {
//                 '/apis': {
//                     target: 'https://maps.googleapis.com',
//                 }
//             }
//         }
//     }
// }
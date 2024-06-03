const webpack = require("webpack");
const path = require("path");
const TerserJSPlugin = require("terser-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

const devMode = process.env.NODE_ENV !== "production";

var plugins = [
  new MiniCssExtractPlugin({
    filename: "../css/[name].css",
    chunkFilename: "../css/[id].css",
    ignoreOrder: false,
  }),
];

if (devMode) {
  plugins.push(new webpack.HotModuleReplacementPlugin());
}

module.exports = {
  entry: {
    frontend: ["./src/frontend/index.js", "./src/frontend/scss/frontend.scss"],
    admin: ["./src/admin/index.js", "./src/admin/scss/admin.scss"],
    style: ["./src/global/style.scss"],
  },
  mode: devMode ? "development" : "production",
  output: {
    path: path.resolve(__dirname, "./assets/js"),
    filename: devMode ? "[name].js" : "[name].min.js",
  },
  devtool: devMode ? "eval-source-map" : false,
  resolve: {
    alias: {
      "@": path.resolve("./src/"),
    },
    modules: ["node_modules", path.resolve("./src")],
  },
  optimization: {
    minimizer: [new TerserJSPlugin({}), new CssMinimizerPlugin()],
    splitChunks: {
      cacheGroups: {
        vendor: {
          test: /[\\\/]node_modules[\\\/]/,
          name: "vendors",
          chunks: "all",
        },
      },
    },
  },
  plugins,
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env", "@babel/preset-react"],
            sourceMap: true,
          },
        },
      },
      {
        test: /\.scss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: "../",
              esModule: false,
            },
          },
          {
            loader: "css-loader",
            options: {
              sourceMap: true,
            },
          },
          {
            loader: "sass-loader",
            options: {
              sourceMap: true,
            },
          },
        ],
      },
      {
        test: /\.(png|jpg|webp|jpeg|gif|ico)$/,
        use: [
          {
            loader: "url-loader",
            options: {
              limit: 8192,
              name: "[path][name].[ext]",
              outputPath: "images/",
            },
          },
        ],
      },
      {
        test: /\.svg$/,
        use: "file-loader",
      },
      {
        test: /\.css$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: (resourcePath, context) =>
                path.relative(path.dirname(resourcePath), context) + "/",
            },
          },
          "css-loader",
        ],
      },
    ],
  },
};

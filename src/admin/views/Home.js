import React, { useState } from "react";
//import ukrFlag from "../assets/images/im_flag-ukr.png";
const Home = () => {
  const [count, setCount] = useState(0);
  const incrementCount = () => {
    setCount(count + 1);
  };
  return (
    <div className="flex justify-center items-center w-full h-[100vh]">
      <div className="space-y-4">
        <h1 className="text-3xl text-center font-bold">
          Welcome To WP React Plugin
        </h1>
        <p className="text-xl text-center font-400">
          Counter: <span className="text-red-500">{count}</span>
        </p>
        <div className="flex justify-center items-center">
          <button
            className="rounded-[35px] px-6 p-4 bg-green-400 text-xl"
            onClick={incrementCount}
          >
            Click Me
          </button>
        </div>
      </div>
      <img src={ukrFlag} alt="" />
    </div>
  );
};

export default Home;

import { createRoot } from 'react-dom/client';

function App() {
  return (
    <>
      <h1>Hello, world!!</h1>
    </>
  );
};
const root = createRoot(document.getElementById('root'));
root.render(<App />);


import React from 'react';
import { Link } from 'react-router-dom';
import SectionHeading from '../Common/SectionHeading';
import { categories } from '../../data/categories';

const CategorySlider = () => {
  return (
    <section className="gap">
      <div className="container">
        <SectionHeading
          subTitle="Find Healthy Product By Category"
          title="Browse By Categories"
        />
        <div className="row justify-content-center g-4 mt-2">
          {categories.map((cat) => (
            <div key={cat.id} className="col-lg-2 col-md-4 col-sm-6 col-6">
              <div className="food-categorie text-center">
                <img src={cat.img} alt={cat.title} className="mb-3" />
                <Link to={cat.link} className="d-block">
                  {cat.title}
                </Link>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default CategorySlider;

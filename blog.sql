alter table Blog.user add constraint foreign key (id_type) references type_user(id) 
	ON delete cascade
    ON UPDATE cascade;
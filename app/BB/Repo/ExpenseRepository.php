<?php namespace BB\Repo;

use BB\Entities\Expense;

class ExpenseRepository extends DBRepository
{

    /**
     * @var Expense
     */
    protected $model;

    /**
     * @param Expense $model
     */
    public function __construct(Expense $model)
    {
        $this->model = $model;
        $this->perPage = 10;
    }

    /**
     * @param integer $id
     * @param integer $userId
     */
    public function approveExpense($id, $userId)
    {
        $expense = $this->model->findOrFail($id);
        $expense->approved = true;
        $expense->declined = false;
        $expense->approved_by_user = $userId;
        $expense->save();

        //Fire an event - this will create the payment
        \Event::fire('expense.approved', [$id]);
    }

    /**
     * @param integer $id
     * @param integer $userId
     */
    public function declineExpense($id, $userId)
    {
        $expense = $this->model->findOrFail($id);
        $expense->approved = false;
        $expense->declined = true;
        $expense->approved_by_user = $userId;
        $expense->save();

        //This event currently doesn't do anything
        \Event::fire('expense.declined', [$id]);
    }


} 
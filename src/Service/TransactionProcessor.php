<?php

namespace App\Service;

use App\Model\Transaction;

readonly class TransactionProcessor
{
    public function __construct(
        private BinService $binService,
        private CurrencyService $currencyService
    )
    {
    }

    /**
     * @param Transaction[] $transactions
     * @return array<int, float>
     * @throws \Exception
     */
    public function processTransactions(array $transactions): array
    {
        $fees = [];

        foreach ($transactions as $transaction) {
            $fees[] = $this->processTransaction($transaction);
        }

        return $fees;
    }

    /**
     * @param Transaction $transaction
     * @return float
     * @throws \Exception
     */
    public function processTransaction(Transaction $transaction): float
    {
        $countryCode = $this->binService->getCountryCode($transaction->getBin());
        $isEu = $this->binService->isEuropeanCountry($countryCode);
        $amountInEur = $this->currencyService->convertToEur($transaction->getAmount(), $transaction->getCurrency());
        $feePercentage = $isEu ? 0.01 : 0.02;
        return $amountInEur * $feePercentage;
    }
}

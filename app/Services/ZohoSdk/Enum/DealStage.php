<?php

namespace App\Services\ZohoSdk\Enum;

enum DealStage: string
{
    case QUALIFICATION = 'Qualification';
    case NEEDS_ANALYSIS = 'Needs Analysis';
    case VALUE_PROPOSITION = 'Value Proposition';
    case IDENTIFY_DECISION_MAKERS = 'Identify Decision Makers';
    case PRICE_QUOTE = 'Proposal/Price Quote';
    case NEGOTIATION = 'Negotiation/Review';
    case CLOSED_WON = 'Closed Won';
    case CLOSED_LOST = 'Closed Lost';
    case CLOSED_TO_COMPETITION = 'Closed-Lost to Competition';

    public static function toArray(): array
    {
        return [
            DealStage::QUALIFICATION->value => DealStage::QUALIFICATION->value,
            DealStage::NEEDS_ANALYSIS->value => DealStage::NEEDS_ANALYSIS->value,
            DealStage::VALUE_PROPOSITION->value => DealStage::VALUE_PROPOSITION->value,
            DealStage::IDENTIFY_DECISION_MAKERS->value => DealStage::IDENTIFY_DECISION_MAKERS->value,
            DealStage::PRICE_QUOTE->value => DealStage::PRICE_QUOTE->value,
            DealStage::NEGOTIATION->value => DealStage::NEGOTIATION->value,
            DealStage::CLOSED_WON->value => DealStage::CLOSED_WON->value,
            DealStage::CLOSED_LOST->value => DealStage::CLOSED_LOST->value,
            DealStage::CLOSED_TO_COMPETITION->value => DealStage::CLOSED_TO_COMPETITION->value,
        ];
    }
}
